public class Libro {
    private String titulo;
    private String autor;
    private String isbn;
    private double precio;
    private int cantidad;

    public Libro(String titulo, String autor, String isbn, double precio, int cantidad) {
        this.titulo = titulo;
        this.autor = autor;
        this.isbn = isbn;
        this.precio = precio;
        this.cantidad = cantidad;
    }

    public String getAutor() {
        return autor;
    }

    public String getIsbn() {
        return isbn;
    }

    public double getPrecio() {
        return precio;
    }

    public String getTitulo() {
        return titulo;
    }

    public int getCanitidad() {
        return cantidad;
    }
}
