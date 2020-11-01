#!/bin/bash
sh 'docker build -t ${DOCKER_IMAGE}:${BUILD_ID} .'
sh 'docker tag ${DOCKER_IMAGE}:${BUILD_ID} ${DOCKER_IMAGE}:lastest'
sh 'docker login -u $DOCKERHUB_USER -p $DOCKERHUB_PW'
sh 'docker push ${DOCKER_IMAGE}:lastest'
