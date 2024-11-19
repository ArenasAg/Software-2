import java.util.ArrayList;
import java.util.List;

class Libro{
    String libro;
    String autor;
    int añoPublicacion;

    public Libro(String libro, String autor, int añoPublicacion){
        this.libro = libro;
        this.autor = autor;
        this.añoPublicacion = añoPublicacion;
    }

    public String getLibro(){
        return libro;
    }

    public String getAutor(){
        return autor;
    }

    public int getAñoPublicacion(){
        return añoPublicacion;
    }

    public void setAñoPublicacion(int añoPublicacion){
        this.añoPublicacion = añoPublicacion;
    }
}

class Biblioteca{
    private List<Libro> libros = new ArrayList<Libro>();

    public void faseAgregarLibro(Libro libro){
        libro.setAñoPublicacion(2021);
        libros.add(libro);
    }
}
public class Main {
    public static void main(String[] args) {
        Biblioteca biblioteca = new Biblioteca();
        Libro libro = new Libro("El principito", "Antoine de Saint-Exupéry", 1943);
        biblioteca.faseAgregarLibro(libro);

        System.out.println("Libro: " + libro.getLibro());
    }
}
