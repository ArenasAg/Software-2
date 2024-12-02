package Cuarta_pregunta;

public class Main {
    public static void main(String[] args) {
        Configuracion config = Configuracion.getInstancia();

        System.out.println("Configuración inicial: " + config);

        config.setUrl("http://localhost:8080");
        config.setUsername("administrador");
        config.setPassword("admin123");

        System.out.println("Configuración nueva: " + config);

        Configuracion otraConfig = Configuracion.getInstancia();
        System.out.println("Otra instancia: " + otraConfig);
    }
}
