public class Main {
    public static void main(String[] args) {
        Settings settings = Settings.getInstance();

        System.out.println("Tema: " + settings.getConfiguracion("theme"));
        System.out.println("Idioma: " + settings.getConfiguracion("language"));

        settings.setConfiguracion("theme", "dark");
        settings.setConfiguracion("language", "es");

        System.out.println("Tema actualizado: " + settings.getConfiguracion("theme"));
        System.out.println("Idioma actualizado: " + settings.getConfiguracion("language"));
    }
}
