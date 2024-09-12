import random
import string
import tkinter as tk
from tkinter import messagebox

def get_random_char(charset):
    return random.choice(charset)

def shuffle_string(s):
    s_list = list(s)
    random.shuffle(s_list)
    return ''.join(s_list)

def generate_password():
    length = 8
    charset = string.ascii_letters + string.digits + "!@#$%^&*(),.?\":{}|<>"
    password = ""

    # Asegura que la contraseña incluya al menos un carácter de cada tipo
    password += get_random_char(string.ascii_lowercase)
    password += get_random_char(string.ascii_uppercase)
    password += get_random_char(string.digits)
    password += get_random_char("!@#$%^&*(),.?\":{}|<>")

    # Llena el resto de la contraseña con caracteres aleatorios
    for _ in range(4, length):
        password += get_random_char(charset)

    # Mezcla los caracteres para evitar patrones predecibles
    password = shuffle_string(password)
    
    # Mostrar la contraseña generada
    result_label.config(text="Contraseña segura recomendada: " + password)

# Configurar la interfaz gráfica
root = tk.Tk()
root.title("Generador de Contraseña Segura")

container = tk.Frame(root, padx=20, pady=20, bg="#f4f4f4")
container.pack(padx=10, pady=10)

title_label = tk.Label(container, text="Generador de Contraseña Segura", font=("Arial", 16), bg="#f4f4f4")
title_label.pack(pady=10)

generate_button = tk.Button(container, text="Generar Contraseña Segura", command=generate_password)
generate_button.pack(pady=10)

result_label = tk.Label(container, text="", font=("Arial", 12, "bold"), fg="green", bg="#f4f4f4", wraplength=300)
result_label.pack(pady=10)

root.mainloop()
