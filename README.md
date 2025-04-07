# Docker Compose Setup for Multi-Service Environment

This repository provides a pre-configured `docker-compose.yml` setup to quickly deploy a set of commonly used services, including **RabbitMQ**, **MySQL**, and **Redis**, in a local development environment. These services are essential components for messaging, database management, and caching, respectively. The configuration is designed to be flexible and extensible, allowing additional services to be easily added to the stack as needed. Each service is pre-configured with default settings, including ports, environment variables, and persistent storage mappings, making it easy to integrate into your workflow or adapt for specific project requirements.

## Prerequisites

- Docker (version 20.10 or higher)
- Docker Compose (version 3.2 or higher)

## Services Overview

### RabbitMQ
- **Image**: `rabbitmq:3-management`
- **Ports**:
    - `5672`: RabbitMQ messaging port
    - `15672`: Management UI
- **Volumes**:
    - Logs: `./rabbitmq/log`
    - Shared data: `./rabbitmq/shared`
    - Definitions: `./rabbitmq/definitions.json`
    - Persistent data: `./rabbitmq/data`
- **Environment Variables**:
    - `RABBITMQ_SERVER_ADDITIONAL_ERL_ARGS`: Configuration for log levels, definitions file, and disk limits.

### MySQL
- **Image**: `mysql:latest`
- **Ports**:
    - `3306`: MySQL port
- **Environment Variables**:
    - `MYSQL_ROOT_PASSWORD`: `root`
    - `MYSQL_DATABASE`: `database`
    - `MYSQL_USER`: `random`
    - `MYSQL_PASSWORD`: `secret`
- **Volumes**:
    - Persistent data: `./mysql`

### Redis
- **Image**: `redis:latest`
- **Ports**:
    - `6379`: Redis port
- **Command**:
  Configured to:
    - Save every 20 seconds if at least 1 key changes.
    - Require password: `secret`.
- **Volumes**:
    - Persistent data: `./redis/data`
    - Configuration files: `./redis/config`

## How to Use

1. **Clone the Repository**:
   ```bash
   git clone git@github.com:equatemedia/rabbit.docker.git
   cd rabbit.docker

2. **Start Services**: Run the following command to start all services:
   ```bash
   docker-compose up -d
3. **Access Services:**
   - **RabbitMQ Management UI**: http://localhost:15672
     - Default credentials: `guest` / `guest`
   - **RabbitMQ Messaging**:  
     Connect to RabbitMQ using the AMQP protocol on `localhost:5672`:
     - Example connection string: `amqp://guest:guest@localhost:5672/`
     - Default credentials: `guest` / `guest`
   - **MySQL**: Connect on `localhost:3306` with the configured credentials.
     - Default credentials: `random` / `secret`
     - Default database: `database`
   - **Redis**: Connect on `localhost:6379` with the password `secret`.
4. **Stop Services:** To stop and remove all containers, use:
   ```bash
   docker-compose down

## Notes

Update the passwords and sensitive information in the environment variables for production use.
