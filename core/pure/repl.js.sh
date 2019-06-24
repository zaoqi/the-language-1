#!/bin/sh
oldpwd="$(pwd)"
cd "$(dirname "$0")" ||exit
bin="$(pwd)"
make ecmascript/lang.js ||exit
cd "$oldpwd" ||exit
node -r "$bin"/repl.js.r.js "$@"
