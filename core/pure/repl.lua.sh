#!/bin/sh
set -e
oldpwd="$(pwd)"
cd "$(dirname "$0")"
bin="$(pwd)"
[ -f  c/lua-5.1.5/src/lua ] || make c/lua-5.1.5/src/lua
make lua/lang_min.lua
cd "$oldpwd"
LUA_PATH="$bin/lua/?.lua;$bin/?.lua" "$bin/c/lua-5.1.5/src/lua" -l repl_lua_r "$@"
