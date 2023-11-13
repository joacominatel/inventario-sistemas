#!/usr/bin/env python3
import sys
import datetime

# Obtén los valores de $sql y $workday_id desde PHP
if len(sys.argv) != 3:
    print("Uso: ./generate_log.py sql workday_id")
    sys.exit(1)

sql = sys.argv[1]
workday_id = sys.argv[2]

# Leer path actual en linux
log_file = "/home/pguzman/inventario-dentsu/logs/registro.log"
timestamp = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")

# Mensaje personalizado que se agregará al registro
message = f"Se ejecutó la sentencia: {sql} con el workday id {workday_id} en {timestamp}"

# Abre el archivo en modo de adición (si no existe, se crea)
with open(log_file, "a") as f:
    f.write(message + "\n")
