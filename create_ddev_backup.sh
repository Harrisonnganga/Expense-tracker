#!/bin/bash

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="database/backups"
TEMP_FILE="$BACKUP_DIR/temp_backup_$DATE.sql.gz"
ENCRYPTED_FILE="$BACKUP_DIR/expense_tracker_$DATE.sql.gz.gpg"

echo "Starting DDEV database backup..."

# Create backup directory
mkdir -p $BACKUP_DIR

# Export database from DDEV (compressed)
echo "📦 Exporting database from DDEV..."
if ddev export-db --gzip --file="$TEMP_FILE"; then
    echo "🔐 Encrypting backup..."
    if gpg --encrypt --recipient "Harrison Ng'ang'a" "$TEMP_FILE"; then
        mv "$TEMP_FILE.gpg" "$ENCRYPTED_FILE"
        rm "$TEMP_FILE"
        echo "✅ Backup created: $ENCRYPTED_FILE"
        echo "📊 Backup size: $(du -h "$ENCRYPTED_FILE" | cut -f1)"
    else
        echo "❌ Encryption failed"
        rm "$TEMP_FILE"
        exit 1
    fi
else
    echo "❌ Database export failed"
    exit 1
fi
