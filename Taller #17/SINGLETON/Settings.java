import java.util.HashMap;
import java.util.Map;

public class Settings {
    private static Settings instance;
    private Map<String, String> configuraciones;

    private Settings() {
        configuraciones = new HashMap<>();
        configuraciones.put("theme", "light");
        configuraciones.put("language", "en");
    }

    public static synchronized Settings getInstance() {
        if (instance == null) {
            instance = new Settings();
        }
        return instance;
    }

    public String getConfiguracion(String key) {
        return configuraciones.get(key);
    }

    public void setConfiguracion(String key, String value) {
        configuraciones.put(key, value);
    }
}
