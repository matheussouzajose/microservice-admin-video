DOCKER_COMPOSE_FILE := docker-compose.yml keycloak/docker-compose.yaml elk/docker-compose.yaml

DOCKER_COMPOSE := docker compose -f

.DEFAULT_GOAL := help

help:
	@echo "Uso: make [alvo]"
	@echo ""
	@echo "Alvos disponíveis:"
	@echo "  up             Inicia todos os contêineres definidos no Docker Compose"
	@echo "  down           Para todos os contêineres e remove os volumes"
	@echo "  restart        Reinicia todos os contêineres"
	@echo "  logs           Exibe logs dos contêineres"
	@echo "  exec           Executa um comando em um serviço específico (exemplo: make exec service=comando)"
	@echo "  ps             Lista os contêineres em execução"
	@echo "  help           Exibe esta mensagem de ajuda"

build:
	@for file in $(DOCKER_COMPOSE_FILE); do \
		${DOCKER_COMPOSE} $${file} up -d --build; \
	done
up:
	@for file in $(DOCKER_COMPOSE_FILE); do \
    	${DOCKER_COMPOSE} $${file} up -d; \
	done

down:
	@for file in $(DOCKER_COMPOSE_FILE); do \
		${DOCKER_COMPOSE} $${file} down -v; \
	done

restart:
	@for file in $(DOCKER_COMPOSE_FILE); do \
		${DOCKER_COMPOSE} $${file} restart; \
	done

logs:
	@for file in $(DOCKER_COMPOSE_FILE); do \
		${DOCKER_COMPOSE} $${file} logs -f; \
	done

exec:
	$(DOCKER_COMPOSE) exec $(service) $(command)

ps:
	@for file in $(DOCKER_COMPOSE_FILE); do \
		${DOCKER_COMPOSE} $${file} ps; \
	done

laravel:
	$(DOCKER_COMPOSE) docker-compose.yml exec app bash

.PHONY: help up down restart logs exec p
