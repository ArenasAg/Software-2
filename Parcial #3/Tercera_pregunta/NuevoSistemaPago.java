package Tercera_pregunta;

public class NuevoSistemaPago {
    private String nombre;
    private String identificacion;
    private String correo;

    public NuevoSistemaPago(String nombre, String identificacion, String correo) {
        this.nombre = nombre;
        this.identificacion = identificacion;
        this.correo = correo;
    }

    public String getNombre() {
        return nombre;
    }

    public String getIdentificacion() {
        return identificacion;
    }

    public String getCorreo() {
        return correo;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setIdentificacion(String identificacion) {
        this.identificacion = identificacion;
    }

    public void setCorreo(String correo) {
        this.correo = correo;
    }
}