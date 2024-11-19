import java.util.ArrayList;
import java.util.List;

public class Carrito {
    private List<Libro> libros = new ArrayList<>();
    private List<Integer> cantidades = new ArrayList<>();

    public void agregarLibro(Libro libro, int cantidad) {
        libros.add(libro);
        cantidades.add(cantidad);
    }

    public void eliminarLibro(Libro libro) {
        int index = libros.indexOf(libro);
        if (index != -1) {
            libros.remove(index);
            cantidades.remove(index);
        }
    }

    public double calcularPrecioTotal() {
        double total = 0;
        for (Libro libro : libros) {
            total += libro.getPrecio() * libro.getCanitidad();
        }
        return total;
    }
}
