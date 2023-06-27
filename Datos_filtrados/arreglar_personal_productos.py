import csv

# personal = []

# with open("personal.csv", 'r') as file:
#         reader = csv.reader(file)
#         next(reader)  # Omitir la primera fila
#         for fila in reader:
#             personal.append(fila)

# i = 0
# for fila in personal:
#     if fila[6] == "Empleado" or fila[6] == "Chofer" or fila[6] == "Repartidor":
#         fila[7] = i
#         if i < 102:
#             i = i + 1
#         else:
#             i = 0

# header_personal = ["id_personal", "nombre", "rut", "edad", "genero", "fecha_inicio", "cargo", "id_tienda"]

# # --- SOBRERESCRIBIR PERSONAL ---
# with open("personal.csv", "w", newline='') as archivo:
#     writer = csv.writer(archivo)
#     writer.writerow(header_personal)
#     writer.writerows(personal)

productos = []
iluminacion = []
dormitorio = []
living = []

with open("productos.csv", 'r') as file:
        reader = csv.reader(file)
        next(reader)  # Omitir la primera fila
        for fila in reader:
            productos.append(fila)
with open("iluminacion.csv", 'r') as file:
        reader = csv.reader(file)
        next(reader)  # Omitir la primera fila
        for fila in reader:
            iluminacion.append(fila)
with open("dormitorio.csv", 'r') as file:
        reader = csv.reader(file)
        next(reader)  # Omitir la primera fila
        for fila in reader:
            dormitorio.append(fila)
with open("living.csv", 'r') as file:
        reader = csv.reader(file)
        next(reader)  # Omitir la primera fila
        for fila in reader:
            living.append(fila)

for prod in productos:
    prod.append("NULL") 
    for ilu in iluminacion:
        if prod[0] == ilu[0]:
            prod[4] = "iluminacion"
    for dorm in dormitorio:
        if prod[0] == dorm[0]:
            prod[4] = "dormitorio"
    for liv in living:
        if prod[0] == liv[0]:
            prod[4] = "living"

header_productos = ["id_producto", "nombre", "precio", "numero_cajas", "categoria"]

# --- SOBRERESCRIBIR PRODUCTOS ---
with open("productos.csv", "w", newline='') as archivo:
    writer = csv.writer(archivo)
    writer.writerow(header_productos)
    writer.writerows(productos)