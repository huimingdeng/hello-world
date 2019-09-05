#!/bin/sh
if [ -z "$1" ]
then
        echo usage: $0 file
        exit
fi
rsync -avze ssh --delete -c --exclude=wp-content/uploads/*  /home/local/httpdocs/$1 remote@www.example.com:/var/www/vhosts/example.com/httpdocs/$1
git.sh