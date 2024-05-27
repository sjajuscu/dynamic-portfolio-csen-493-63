package CSEN275.DPG.repository;

import CSEN275.DPG.model.Project;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ProjectRepository extends JpaRepository<Project, Long> {
}
