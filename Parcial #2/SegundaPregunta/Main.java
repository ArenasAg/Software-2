package SegundaPregunta;

public class Main {
    public static void main(String[] args) {
        Tarea tarea = new Tarea("Comer", "Hacer la comida");
        Notificacion notificacion = new Notificacion("Ola");

        Notificador notificador = new Notificador();
        notificador.enviarPorSMS(notificacion);
        notificador.enviarPorWhatsapp(notificacion);

        TareaManager tareaManager = new TareaManager();
        tareaManager.insertarTarea(tarea);
        tareaManager.leerTarea();
    }
}

class Tarea{
    private String nombre;
    private String descripcion;

    public Tarea(String nombre, String descripcion){
        this.nombre = nombre;
        this.descripcion = descripcion;
    }
    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }
}

class Notificacion{
    private String mensaje;

    public String getMensaje() {
        return mensaje;
    }

    public void setMensaje(String mensaje) {
        this.mensaje = mensaje;
    }

    public Notificacion(String mensaje) {
        this.mensaje = mensaje;
    }

    
}

class Notificador {
    public void enviarPorSMS(Notificacion notificacion) {
        System.out.println("ENVIANDO NOTIFICACION POR SMS");
    }

    public void enviarPorWhatsapp(Notificacion notificacion) {
        System.out.println("ENVIANDO NOTIFICACION POR WHATSAPP");
    }
}

class TareaManager {
    public void insertarTarea(Tarea tarea) {
        System.out.println("INSERTANDO TAREA");
    }

    public void leerTarea() {
        System.out.println("OBTENIENDO UNA TAREA");
    }
}
