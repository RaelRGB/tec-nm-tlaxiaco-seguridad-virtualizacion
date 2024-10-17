import sqlite3
from flask import Flask, request, render_template_string

app = Flask(__name__)


@app.route("/")
def index():
    html = """
    <form action="/search" method="get">
        <input type="text" name="query" placeholder="Buscar">
        <input type="submit" value="Buscar">
    </form>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
            {% for row in registros %}
                <tr>
                    <td>{{ row[0] }}</td>
                    <td>{{ row[1] }}</td>
                    <td>{{ row[2] }}</td>
                </tr>
            {% endfor %}
        </table>
    </div>
    """
    # Conectarse a la base de datos y obtener todos los registros
    conn = sqlite3.connect("registros.db")
    c = conn.cursor()
    c.execute("SELECT id, nombre, descripcion FROM registros ORDER BY id DESC")
    registros = c.fetchall()  # Obtiene todos los registros
    conn.close()

    # Renderiza la plantilla HTML
    return render_template_string(html, registros=registros)


@app.route("/search")
def search():
    query = request.args.get("query")
    conn = sqlite3.connect("registros.db")
    c = conn.cursor()

    # Consulta segura usando parámetros para evitar inyecciones SQL
    # c.execute(
    #    "SELECT * FROM registros WHERE id = ? OR nombre = ? OR descripcion = ?",
    #   (query, query, query),
    # )

    # Consulta no segura usando parámetros para evitar inyecciones SQL
    c.execute(
        f"SELECT * FROM registros WHERE id = '{query}' OR nombre = '{query}' OR descripcion = '{query}'"
    )
    # Se puede inyectar código SQL en el campo de búsqueda y obtener información no deseada
    # ejemplo:
    #  - Buscar por id = 1 OR 1=1 -- Esto devolverá todos los registros de la tabla (lo que no queremos), ya que 1=1 siempre es verdadero y se ignorará el resto de la condición
    #  - Buscar por name = ' OR 1=1 --Esto devolverá todos los registros de la tabla (lo que no queremos), ya que 1=1 siempre es verdadero y se ignorará el resto de la condición
    # - Buscar por name = ' OR 1=1; DROP TABLE table; -- Esto eliminará la tabla (lo que no queremos), esto sucede si el usuario ingresa un valor malicioso en el campo de búsqueda y el usuario de la BD tiene permisos para eliminar tablas

    registros = c.fetchall()
    conn.close()

    # resultados de la búsqueda
    html = """
    <form action="/search" method="get">
        <input type="text" name="query" placeholder="Buscar" value="{{ query }}">
        <input type="submit" value="Buscar">
    </form>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
            {% for row in registros %}
                <tr>
                    <td>{{ row[0] }}</td>
                    <td>{{ row[1] }}</td>
                    <td>{{ row[2] }}</td>
                </tr>
            {% endfor %}
        </table>
    </div>
    """

    # Renderiza los resultados de la búsqueda
    return render_template_string(html, registros=registros, query=query)

if __name__ == "__main__":
    app.run(
        debug=True
    )  # Activar el modo de depuración para ver más detalles de los errores