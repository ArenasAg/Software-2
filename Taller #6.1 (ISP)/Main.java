public class Main {
    public static void main(String[] args) {
        Libro miLibro = new Libro("Cien Años de Soledad", "imagen1.jpg", 500, 1, 3);

        System.out.println("Probando la clase libro:");
        System.out.println("Título: " + miLibro.getTitulo());
        miLibro.prestar();
        miLibro.devolver();
        miLibro.renovarPortada();
        miLibro.mantenimientoHojas();
        miLibro.solicitarVersion();

        Dvd miDVD = new Dvd("Inception", 5);

        System.out.println("\nProbando la clase dvd:");
        System.out.println("Título: " + miDVD.getTitulo());
        miDVD.prestar();
        miDVD.devolver();

        Cartilla miCartilla = new Cartilla("Manual de Java", 100, 2);

        System.out.println("\nProbando la clase cartilla:");
        System.out.println("Título: " + miCartilla.getTitulo());
        miCartilla.prestar();
        miCartilla.devolver();
        miCartilla.mantenimientoHojas();
    }
}