FROM python:3.11-slim

ENV PYTHONUNBUFFERED=1

WORKDIR /opt/verification

# Install Docker CLI (client only) so reset.sh can call docker when the socket is mounted
RUN apt-get update \
    && apt-get install -y --no-install-recommends curl ca-certificates \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://download.docker.com/linux/static/stable/x86_64/docker-26.1.4.tgz -o /tmp/docker.tgz \
    && tar -xf /tmp/docker.tgz -C /tmp \
    && mv /tmp/docker/docker /usr/local/bin/docker \
    && chmod +x /usr/local/bin/docker \
    && rm -rf /tmp/docker /tmp/docker.tgz

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

