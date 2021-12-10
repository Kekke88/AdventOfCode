#!/bin/bash
YEAR=$(date +"%Y")
for e in $(find . -type f -name 'app.php' | sort -t '\0' -n | tail -5); do
        n=$(echo $e | cut -d/ -f3)
        echo "::set-output name=$n-name::**day$n**"
        i=0
        echo "::set-output name=$n-result-$i::\`\`\`"
        php $e | while IFS= read -r l; do
                ((i++))
                echo "::set-output name=$n-result-$i::$(echo $l | tr '\n' ' ')"
        done
        echo "::set-output name=$n-result-4::\`\`\`"
done