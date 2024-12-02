package Cuarta_pregunta;

public class Configuracion {
    private static Configuracion instanciaUnica;

    private String url;
    private String username;
    private String password;

    private Configuracion() {
        this.url = "https://localhost:443";
        this.username = "anderson";
        this.password = "anderson123";
    }

    public static Configuracion getInstancia() {
        if (instanciaUnica == null) {
            instanciaUnica = new Configuracion();
        }
        return instanciaUnica;
    }

    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    @Override
    public String toString() {
        return "Configuracion {url='" + url + "', username='" + username + "', password='" + password + "'}";
    }
}
