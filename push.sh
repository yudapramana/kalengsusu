#!/bin/bash

echo "Enter commit message:"
read message

git add --ignore-errors .
git commit -m "$message"
git push
