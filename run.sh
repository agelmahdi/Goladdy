#!/bin/bash

function info(){
  echo "
  
  $1
  
  "
}

info "Building the docker setup..."
make make-init
make docker-build

info "Starting the docker setup..."
make docker-down
make docker-up

info "DB init, migrate, and seeding..."
sleep 0.5
make setup-db ARGS=--drop


