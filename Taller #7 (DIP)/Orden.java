public class Orden {
    private String id;
    private String descripcion;
    private String direccionEnvio;

    public Orden(String id, String descripcion, String direccionEnvio) {
        this.id = id;
        this.descripcion = descripcion;
        this.direccionEnvio = direccionEnvio;
    }

    public String getId() {
        return id;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public String getDireccionEnvio() {
        return direccionEnvio;
    }

    @Override
    public String toString() {
        return "Orden{" +
                "id='" + id + '\'' +
                ", descripcion='" + descripcion + '\'' +
                ", direccionEnvio='" + direccionEnvio + '\'' +
                '}';
    }
}
