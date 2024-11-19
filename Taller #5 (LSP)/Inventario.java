abstract class Producto {
    protected String nombre;
    protected double precio;
    protected int cantidad;

    // Constructor para inicializar los atributos del producto
    public Producto(String nombre, double precio, int cantidad) {
        this.nombre = nombre;
        this.precio = precio;
        this.cantidad = cantidad;
    }

    // Métodos getter para obtener el nombre, precio y cantidad del producto
    public String getNombre() {
        return nombre;
    }

    public double getPrecio() {
        return precio;
    }

    public int getCantidad() {
        return cantidad;
    }

    // Método para calcular el costo total del producto basado en su precio y cantidad
    public double calcularCostoTotal() {
        return precio * cantidad;
    }

    // Método abstracto que obliga a las subclases a implementar cómo procesar el producto
    public abstract void procesarProducto();
}

// Interface para productos que pueden ser enviados por correo
interface Enviable {
    void enviarPorCorreo();
}

// Clase para productos físicos que extiende la clase abstracta Producto e implementa la interfaz Enviable
class ProductoFisico extends Producto implements Enviable {
    private double peso;  // Peso del producto físico

    public ProductoFisico(String nombre, double precio, int cantidad, double peso) {
        super(nombre, precio, cantidad);  // Llamada al constructor de la clase padre
        this.peso = peso;
    }

    public double getPeso() {
        return peso;
    }

    // Implementación del método abstracto procesarProducto
    @Override
    public void procesarProducto() {
        double costoTotal = calcularCostoTotal();  // Calcula el costo total del producto
        System.out.println(getNombre() + " costo total: " + costoTotal);
        enviarPorCorreo();  // Llama al método de la interfaz Enviable para enviar el producto
    }

    // Implementación del método enviarPorCorreo de la interfaz Enviable
    @Override
    public void enviarPorCorreo() {
        System.out.println("Enviando el producto físico '" + getNombre() + "' por correo.");
    }
}

// Clase para productos digitales que extiende la clase abstracta Producto
class ProductoDigital extends Producto {
    private double tamanioArchivo;  // Tamaño del archivo del producto digital

    public ProductoDigital(String nombre, double precio, int cantidad, double tamanioArchivo) {
        super(nombre, precio, cantidad);  // Llamada al constructor de la clase padre
        this.tamanioArchivo = tamanioArchivo;
    }

    public double getTamanioArchivo() {
        return tamanioArchivo;
    }

    // Implementación del método abstracto procesarProducto
    @Override
    public void procesarProducto() {
        double costoTotal = calcularCostoTotal();  // Calcula el costo total del producto
        System.out.println(getNombre() + " costo total: " + costoTotal);
    }
}

// Clase para productos mixtos que extiende la clase abstracta Producto e implementa la interfaz Enviable
class ProductoMixto extends Producto implements Enviable {
    private double peso;  // Peso del componente físico del producto mixto
    private double tamanioArchivo;  // Tamaño del archivo del componente digital del producto mixto

    public ProductoMixto(String nombre, double precio, int cantidad, double peso, double tamanioArchivo) {
        super(nombre, precio, cantidad);  // Llamada al constructor de la clase padre
        this.peso = peso;
        this.tamanioArchivo = tamanioArchivo;
    }

    public double getPeso() {
        return peso;
    }

    public double getTamanioArchivo() {
        return tamanioArchivo;
    }

    // Implementación del método abstracto procesarProducto
    @Override
    public void procesarProducto() {
        double costoTotal = calcularCostoTotal();  // Calcula el costo total del producto
        System.out.println(getNombre() + " costo total: " + costoTotal);
        enviarPorCorreo();  // Llama al método de la interfaz Enviable para enviar el producto
    }

    // Implementación del método enviarPorCorreo de la interfaz Enviable
    @Override
    public void enviarPorCorreo() {
        System.out.println("Enviando el producto mixto '" + getNombre() + "' por correo.");
    }
}

public class Inventario {
    public static void main(String[] args) {
        // Creación de instancias de diferentes tipos de productos
        ProductoFisico libro = new ProductoFisico("Libro", 20.0, 3, 1.5);
        ProductoDigital eBook = new ProductoDigital("eBook", 10.0, 5, 2.0);
        ProductoMixto combo = new ProductoMixto("Combo Libro + eBook", 25.0, 2, 1.5, 2.0);

        // Procesa cada producto llamando a su método específico procesarProducto
        procesarProducto(libro);
        procesarProducto(eBook);
        procesarProducto(combo);
    }

    // Método que procesa el producto llamando al método procesarProducto() de cada instancia
    private static void procesarProducto(Producto producto) {
        producto.procesarProducto();
    }
}
