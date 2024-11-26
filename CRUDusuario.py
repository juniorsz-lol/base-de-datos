import sqlite3

class CRUDusuarios:
    def __init__(self, db_name="database.db"):
        self.conn = sqlite3.connect(db_name)
        self.cursor = self.conn.cursor()
        self.crear_tabla()

    def crear_tabla(self):
        """Crea la tabla si este no existe"""
        self.cursor.execute('''
        CREATE TABLE IF NOT EXISTS registro (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            correo TEXT NOT NULL,
            contraseña TEXT NOT NULL
        )
        ''')
        self.conn.commit()

    def crear(self, nombre, correo, contraseña):
        """Inserta un nuevo registro de usuario."""
        self.cursor.execute(
            'INSERT INTO registro (nombre, correo, contraseña) VALUES (?, ?, ?)',
            (nombre, correo, contraseña)
        )
        self.conn.commit()
        print("Registro creado exitosamente.")

    def leer(self):
        """Lee y retorna todos los registros."""
        self.cursor.execute('SELECT * FROM registro')
        registros = self.cursor.fetchall()
        for registro in registros:
            print(f"ID: {registro[0]}, Nombre: {registro[1]}, Correo: {registro[2]}, Contraseña: {registro[3]}")
        return registros

    def actualizar(self, id, nuevo_nombre, nuevo_correo, nueva_contraseña):
        """Actualiza un registro existente."""
        self.cursor.execute(
            '''
            UPDATE registro
            SET nombre = ?, correo = ?, contraseña = ?
            WHERE id = ?
            ''',
            (nuevo_nombre, nuevo_correo, nueva_contraseña, id)
        )
        self.conn.commit()
        print("Registro actualizado exitosamente.")

    def eliminar(self, id):
        """Elimina un registro por su ID."""
        self.cursor.execute('DELETE FROM registro WHERE id = ?', (id,))
        self.conn.commit()
        print("Registro eliminado exitosamente.")

    def cerrar_conexion(self):
        """Cierra la conexión a la base de datos."""
        self.conn.close()


class Aplicacion:
    def __init__(self):
        self.db = CRUDusuarios()

    def menu(self):
        """Menú interactivo para el CRUD."""
        while True:
            print("\nOpciones:")
            print("1. Crear USUARIO")
            print("2. Leer registros")
            print("3. Actualizar USUARIO")
            print("4. Eliminar USUARIA")
            print("5. Salir")
            opcion = input("Selecciona una opción: ")

            if opcion == '1':
                self.crear_registro()
            elif opcion == '2':
                self.leer_registros()
            elif opcion == '3':
                self.actualizar_registro()
            elif opcion == '4':
                self.eliminar_registro()
            elif opcion == '5':
                print("Saliendo del programa.")
                self.db.cerrar_conexion()
                break
            else:
                print("Opción no válida, intenta de nuevo.")

    def crear_registro(self):
        """Lógica para crear un registro."""
        nombre = input("Nombre: ")
        correo = input("Correo: ")
        contraseña = input("Contraseña: ")
        self.db.crear(nombre, correo, contraseña)

    def leer_registros(self):
        """Lógica para leer registros."""
        print("Registros:")
        self.db.leer()

    def actualizar_registro(self):
        """Lógica para actualizar un registro."""
        id = int(input("ID del registro a actualizar: "))
        nuevo_nombre = input("Nuevo nombre: ")
        nuevo_correo = input("Nuevo correo: ")
        nueva_contraseña = input("Nueva contraseña: ")
        self.db.actualizar(id, nuevo_nombre, nuevo_correo, nueva_contraseña)

    def eliminar_registro(self):
        """Lógica para eliminar un registro."""
        id = int(input("ID del registro a eliminar: "))
        self.db.eliminar(id)


# Ejecutar la aplicación
if __name__ == "__main__":
    app = Aplicacion()
    app.menu()
