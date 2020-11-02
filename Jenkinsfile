pipeline {
  agent none
  parameters {
    choice(
    name: 'PROJECT', choices: ['ALL', 'NODEJS', 'PYTHON'], description: 'PROJECT TO CI/CD')
  }
  environment {
    DOCKERHUB_PW = credentials('dockerhub_pw')
    DOCKERHUB_USER = 'luandnh1998'
  }
  stages {
    stage("Build") {
      parallel {
        stage("Build NodeJS") {
          agent {
            label 'node1'
          }
          when {
            expression {
              params.PROJECT == 'NODEJS' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "NodeJS GIT";
            script {
              env.DOCKER_IMAGE = "luandnh1998/nodejs";
            }

            git 'https://github.com/luandnh/node-hello.git';
            sh './jenkins/build.sh';
          }
        }
        stage("Build Python") {
          agent {
            label 'node1'
          }
          when {
            expression {
              params.PROJECT == 'PYTHON' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "Python GIT"
            script {
              env.DOCKER_IMAGE = "luandnh1998/pythonhello";
            }
            git 'https://github.com/luandnh/python-hello.git';
            sh './jenkins/build.sh';
          }
        }
      }
    }
    stage("Push") {
      parallel {
        stage("Push NodeJS") {
          agent {
            label 'node1'
          }
          when {
            expression {
              params.PROJECT == 'NODEJS' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "NodeJS GIT";
            script {
              env.DOCKER_IMAGE = "luandnh1998/nodejs";
            }
            git 'https://github.com/luandnh/node-hello.git';
            sh './jenkins/push.sh';
          }
        }
        stage("Push Python") {
          agent {
            label 'node1'
          }
          when {
            expression {
              params.PROJECT == 'PYTHON' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "Python GIT";
            script {
              env.DOCKER_IMAGE = "luandnh1998/pythonhello";
            }
            git 'https://github.com/luandnh/python-hello.git';
            sh './jenkins/push.sh';
          }
        }
      }
    }
    stage("Deploy") {
      parallel {
        stage("Deploy NodeJS") {
          agent {
            label 'node2'
          }
          when {
            expression {
              params.PROJECT == 'NODEJS' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "NodeJS GIT";
            script {
              env.DOCKER_IMAGE = "luandnh1998/nodejs";
            }
            git 'https://github.com/luandnh/node-hello.git';
            echo "Remove Old Container";
            sh './scripts/remove_old_container.sh';
            sh './jenkins/deploy.sh';
          }
        }
        stage("Deploy Python") {
          agent {
            label 'node2'
          }
          when {
            expression {
              params.PROJECT == 'PYTHON' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "Python GIT";
            script {
              env.DOCKER_IMAGE = "luandnh1998/pythonhello";
            }
            git 'https://github.com/luandnh/python-hello.git';
            echo "Remove Old Container";
            sh './scripts/remove_old_container.sh';
            sh './jenkins/deploy.sh';
          }
        }
      }
    }
  }
}