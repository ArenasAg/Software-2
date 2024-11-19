package PrimerPregunta.CONTROLADOR;

import java.util.List;

public class Main {
    public static void main(String[] args) {
        Libro libro = new Libro("El principito", "No se", 20000.0, "2024");
        Libreria librerias = new Libreria();
        librerias.añadirLibro(libro);
        Libro libroAutor = librerias.buscarLibroAutor("No se");
        Libro libroTitulo = librerias.buscarLibroTitulo("El principito");
        Libro libroAnio = librerias.obtenerLibroAnio("2024");
        Libro libroPrecio = librerias.obtenerLibroRangoPrecio(10000.0, 30000.0);

        System.out.println(libroAutor);
        System.out.println(libroTitulo);
        System.out.println(libroAnio);
        System.out.println(libroPrecio);
    }
}

class Libro {
    private String titulo;
    private String autor;
    private double precio;
    private String anio;

    public Libro(String titulo, String autor, double precio, String anio){
        this.titulo = titulo;
        this.autor = autor;
        this.precio = precio;
        this.anio = anio;
    }

    public String getTitulo(){
        return titulo;
    }

    public String getAutor(){
        return autor;
    }

    public double getPrecio(){
        return precio;
    }

    public String getAnio(){
        return anio;
    }
}

class Libreria{
    private List<Libro> libros;

    public void añadirLibro(Libro libro){
        this.libros.add(libro);
    }

    public Libro buscarLibroTitulo(String titulo){
         for (Libro libro: libros) {
            if(libro.getTitulo().equals(titulo)){
                return libro;
            }
         }
        return null;
    }

    public Libro buscarLibroAutor(String autor){
        for (Libro libro: libros) {
            if(libro.getAutor().equals(autor)){
                return libro;
            }
         }
         return null;
    }

    public Libro obtenerLibroRangoPrecio(double precio1, double precio2){
        for (Libro libro: libros) {
            if(libro.getPrecio() > precio1 && libro.getPrecio() < precio2){
                return libro;
            }
         }
         return null;
    }

    public Libro obtenerLibroAnio(String anio){
        for (Libro libro: libros) {
            if(libro.getAnio().equals(anio)){
                return libro;
            }
         }
         return null;
    }
}