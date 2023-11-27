#!/usr/bin/env bash

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

for service in "${SERVICES[@]}"; do
  docker-compose -f "./apps/${service}/docker-compose.yml" down
  echo "${service} down is complete"
done

for service in "${SERVICES[@]}"; do
  docker rmi $(docker images | grep "${service}")
  echo "${service} image is removed"
done

echo =============================================================================
echo "remove network rentnet"
echo -----------------------------------------------------------------------------
docker network rm rentnet

echo services down is complete

#clear
docker ps

# docker rmi $(docker images -a -q)
# docker rmi $(docker images | grep 'adminer')
# docker images -a |  grep "pattern"
# docker system prune
# docker system prune -a

# docker container stop $(docker container ls -aq)
# docker container rm $(docker container ls -aq)
# docker images -f dangling=true
# docker volume rm $(docker volume ls -q --filter dangling=true)
