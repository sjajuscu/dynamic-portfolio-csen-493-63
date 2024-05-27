package CSEN275.DPG.repository;

import CSEN275.DPG.model.EducationalDetails;
import org.springframework.data.jpa.repository.JpaRepository;

public interface EducationRepository extends JpaRepository<EducationalDetails, Long> {
}
