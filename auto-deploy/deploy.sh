
#!/bin/bash
docker login -u luandnh1998 -p jenkins1998
docker pull luandnh1998/nodejs:lastest
docker run -d -p 3000:3000 -e APP_VERSION=V1-autodeploy -e APP_HOSTNAME=node2 --name=helloworld-nodejs luandnh1998/nodejs:lastest