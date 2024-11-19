public class SistemaEnvios {
    private IDHLEnvio dhlEnvio;
    private IFedExEnvio fedExEnvio;
    private IUPSEnvio upsEnvio;

    public SistemaEnvios(IDHLEnvio dhlEnvio, IFedExEnvio fedExEnvio, IUPSEnvio upsEnvio) {
        this.dhlEnvio = dhlEnvio;
        this.fedExEnvio = fedExEnvio;
        this.upsEnvio = upsEnvio;
    }

    public void enviarPorDHL(Orden orden) {
        dhlEnvio.enviarPorDHL(orden);
    }

    public void enviarPorFedEx(Orden orden) {
        fedExEnvio.enviarPorFedEx(orden);
    }

    public void enviarPorUPS(Orden orden) {
        upsEnvio.enviarPorUPS(orden);
    }
}
