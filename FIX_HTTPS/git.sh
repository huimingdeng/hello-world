#!/bin/sh
cd /home/gcdev2/httpdocs/
git add --all
git commit -a -m "$(echo Author IP $SSH_CLIENT)"