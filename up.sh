#!/usr/bin/env bash

echo =============================================================================
echo "create network bridge rentnet"
echo -----------------------------------------------------------------------------
docker network create -d bridge rentnet

echo =============================================================================
echo "read services from .services.env file"
echo -----------------------------------------------------------------------------

SERVICES=()
if [ -f .services.env ]; then
  while IFS= read -r line; do
    [[ $line =~ ^\# ]] && continue
    [ -z "${line//[$'\t\r\n ']/}" ] && continue
    STR=${line//[$'\t\r\n ']/}
    SERVICES+=("$STR")
    echo "[$STR] found"
  done <.services.env
fi

echo =============================================================================
echo "read services from .services_wait.env file"
echo -----------------------------------------------------------------------------
SERVICES_WAIT=()
if [ -f .services_wait.env ]; then
  while IFS= read -r line; do
    [[ $line =~ ^\# ]] && continue
    [ -z "${line//[$'\t\r\n ']/}" ] && continue
    STR=${line//[$'\t\r\n ']/}
    SERVICES_WAIT+=("$STR")
  done <.services_wait.env
fi

TIMEOUT=60

for service in "${SERVICES[@]}"; do
  echo "${service} up init"

  docker-compose -f "./apps/${service}/docker-compose.yml" up --build -d

  for service_wait in "${SERVICES_WAIT[@]}"; do
    if [ "${service_wait}" = "${service}" ]; then
      echo "${service_wait}" is prepare...
      sleep $TIMEOUT
    fi
  done

  echo "${service} up is complete"
done

echo services up is complete

#clear
docker ps
