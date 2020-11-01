#!/bin/bash
docker build -t ${DOCKER_IMAGE}:${BUILD_ID} .
docker tag ${DOCKER_IMAGE}:${BUILD_ID} ${DOCKER_IMAGE}:lastest
docker login -u $DOCKERHUB_USER -p $DOCKERHUB_PW
docker push ${DOCKER_IMAGE}:lastest
