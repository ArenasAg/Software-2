public class Main {
    public static void main(String[] args) {
        Libro libro1 = new Libro("El principito", "Autor1", "ISBN1", 100.0, 5);

        Carrito carrito = new Carrito();
        carrito.agregarLibro(libro1, 2);

        System.out.println("Precio total del carrito: " + carrito.calcularPrecioTotal());
    }
}
