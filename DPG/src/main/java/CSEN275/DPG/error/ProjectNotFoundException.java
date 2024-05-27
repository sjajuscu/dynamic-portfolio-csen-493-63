package CSEN275.DPG.error;

public class ProjectNotFoundException extends RuntimeException {
    public ProjectNotFoundException(Long id) {
        super("Could not find project details with id=" + id);
    }
}