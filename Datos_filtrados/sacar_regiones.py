import csv

regiones = []

with open("comuna_region.csv", 'r') as file:
        reader = csv.reader(file)
        next(reader)  # Omitir la primera fila
        for fila in reader:
            if fila[1] not in regiones:
                regiones.append(fila[1])

for region in regiones:
    print(f'<option value="{region}">{region}</option>')