#!/bin/bash -x

printf "Installing base system \n"

apt-get update && apt-get install -y \
    git \
    zip