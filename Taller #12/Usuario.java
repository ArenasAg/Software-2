public class Usuario {
    private String nombre;
    private String documento;

    public Usuario(String nombre, String documento) {
        this.nombre = nombre;
        this.documento = documento;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getdocumento() {
        return documento;
    }

    public void setdocumento(String documento) {
        this.documento = documento;
    }
}