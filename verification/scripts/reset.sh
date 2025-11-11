#!/bin/bash
set -euo pipefail

APP_DIR="${APP_SOURCE_DIR:-/workspace/idea_1}"
IMAGE_NAME="${APP_IMAGE_NAME:-vuln_app}"
CONTAINER_NAME="${APP_CONTAINER_NAME:-vuln_app}"
PORT_MAPPING="${APP_PORT_MAPPING:-8080:80}"

if ! command -v docker >/dev/null 2>&1; then
  echo "Docker not available on PATH. Mount the Docker socket into the verification container." >&2
  exit 1
fi

# Restore repository state if git metadata is present
if [ -d "${APP_DIR}/.git" ]; then
  echo "[reset] Restoring application sources from origin/main..."
  git -C "${APP_DIR}" fetch origin >/dev/null 2>&1 || true
  git -C "${APP_DIR}" reset --hard origin/main >/dev/null 2>&1 || true
fi

echo "[reset] Rebuilding image '${IMAGE_NAME}' from '${APP_DIR}'..."
docker rm -f "${CONTAINER_NAME}" >/dev/null 2>&1 || true
docker build -t "${IMAGE_NAME}" "${APP_DIR}"

echo "[reset] Launching container '${CONTAINER_NAME}'..."
docker run -d -p "${PORT_MAPPING}" --name "${CONTAINER_NAME}" "${IMAGE_NAME}" >/dev/null

echo "[reset] Done."

