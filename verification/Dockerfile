FROM python:3.11-slim

ENV PYTHONUNBUFFERED=1

WORKDIR /opt/verification

# Install Docker CLI (client only) so reset.sh can call docker when the socket is mounted
RUN apt-get update \
    && apt-get install -y --no-install-recommends curl ca-certificates gnupg lsb-release \
    && install -m 0755 -d /etc/apt/keyrings \
    && curl -fsSL https://download.docker.com/linux/debian/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg \
    && chmod a+r /etc/apt/keyrings/docker.gpg \
    && echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/debian $(lsb_release -cs) stable" > /etc/apt/sources.list.d/docker.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends docker-ce-cli \
    && rm -rf /var/lib/apt/lists/*

COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

COPY app ./app
COPY scripts ./scripts

RUN chmod +x ./scripts/reset.sh

ENV TARGET_ORIGIN=http://localhost:8080 \
    TARGET_APP_PATH=/app \
    FLAG_SQL=FLAG{SQL_FIX_CONFIRMED} \
    FLAG_IDOR=FLAG{IDOR_FIX_CONFIRMED} \
    FLAG_RCE=FLAG{UPLOAD_FIX_CONFIRMED} \
    APP_SOURCE_DIR=/workspace/idea_1 \
    APP_IMAGE_NAME=vuln_app \
    APP_CONTAINER_NAME=vuln_app \
    APP_PORT_MAPPING=8080:80

EXPOSE 5000

CMD ["python", "-m", "app.server"]

