package Quinta_pregunta;

public class ReiniciarComputadorCommand implements Command {
    private Computador computador;

    public ReiniciarComputadorCommand(Computador computador) {
        this.computador = computador;
    }

    @Override
    public void execute() {
        computador.reiniciar();
    }
}