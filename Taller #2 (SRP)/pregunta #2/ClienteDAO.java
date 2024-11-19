import java.util.ArrayList;
import java.util.List;

// Clase para gestionar el almacenamiento de clientes
public class ClienteDAO {
    private List<Cliente> clientes;

    // Constructor que inicializa la lista de clientes
    public ClienteDAO() {
        this.clientes = new ArrayList<>();
    }

    // Método para agregar un nuevo cliente
    public void agregarCliente(Cliente cliente) {
        clientes.add(cliente);
    }

    // Método para listar todos los clientes
    public List<Cliente> listarClientes() {
        return new ArrayList<>(clientes);
    }
}