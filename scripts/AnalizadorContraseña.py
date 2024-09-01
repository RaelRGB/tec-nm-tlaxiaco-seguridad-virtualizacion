import re

def es_contraseña_segura(contraseña):
    # Criterios de validación
    longitud = len(contraseña) >= 8
    mayuscula = re.search(r'[A-Z]', contraseña)
    minuscula = re.search(r'[a-z]', contraseña)
    numero = re.search(r'[0-9]', contraseña)
    caracter_especial = re.search(r'[@#$%^&+=]', contraseña)

# Validar que no haya dos letras, números o símbolos consecutivos

    sin_repetidos = not re.search(r'(.)\1', contraseña)

    # Validar la seguridad de la contraseña

    if longitud and mayuscula and minuscula and numero and caracter_especial and sin_repetidos:
        return True
    else:
        return False
    
# Solicitar al usuario que ingrese una contraseña

contraseña = input("Ingresa una contraseña: ")

# Validar y mostrar el resultado

if es_contraseña_segura(contraseña):
    print("La contraseña es segura.")
else:
    print("La contraseña no es segura. Asegúrate de que tenga al menos 8 caracteres, incluya mayúsculas, minúsculas, números y caracteres especiales.")
