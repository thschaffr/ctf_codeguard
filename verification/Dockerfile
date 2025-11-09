FROM python:3.11-slim

ENV PYTHONUNBUFFERED=1 \
    POETRY_VERSION=1.8.3

WORKDIR /opt/verification

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

