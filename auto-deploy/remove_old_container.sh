#!/bin/bash
CONTAINER_NAME="helloworld-nodejs"
OLD="$(docker ps --all --quiet --filter=name="$CONTAINER_NAME")"
if [ -n "$OLD" ]; then
  docker stop $OLD && docker rm $OLD
fi