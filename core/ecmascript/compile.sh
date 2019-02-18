#!/bin/sh
tsc --build tsconfig.json || exit
js="$(cat lang.js)"
cat > lang.js << EOF
// Generated by compile.sh
$js
EOF

google-closure-compiler -W QUIET --strict_mode_input --language_out ECMASCRIPT3 --js lang.js --externs lang.min.externs.js > lang.min.js
