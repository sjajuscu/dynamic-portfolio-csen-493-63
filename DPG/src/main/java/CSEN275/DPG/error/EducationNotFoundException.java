package CSEN275.DPG.error;

public class EducationNotFoundException extends RuntimeException {
    public EducationNotFoundException(Long id) {
        super("Could not find educational details with id=" + id);
    }
}
