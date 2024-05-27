package CSEN275.DPG;

import CSEN275.DPG.model.EducationalDetails;
import CSEN275.DPG.model.ExperienceDetails;
import CSEN275.DPG.model.Project;
import CSEN275.DPG.repository.EducationRepository;
import CSEN275.DPG.repository.ExperienceRepository;
import CSEN275.DPG.repository.PortfolioRepository;
import CSEN275.DPG.repository.ProjectRepository;
import CSEN275.DPG.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.autoconfigure.orm.jpa.DataJpaTest;

@DataJpaTest
public class DatabaseTest {
    @Autowired
    UserRepository userRepository;

    @Autowired
    PortfolioRepository portfolioRepository;

    @Autowired
    EducationRepository educationRepository;

    @Autowired
    ExperienceRepository experienceRepository;

    @Autowired
    ProjectRepository projectRepository;

    public static EducationalDetails createSCUDetails() {
        String school = "SCU";
        String majors = "CSEN, AMTH";
        int start = 2024;
        return new EducationalDetails(school, "Master", majors, start, start);
    }

    static ExperienceDetails createJobExperience() {
        String company = "Google";
        String details = "Software Developer Intern";
        int start = 2020;
        int end = 2022;
        return new ExperienceDetails(company, details, start, end);
    }

    static Project createProject() {
        String title = "ML AI";
        String details = "Created a machine learning algorithm for artificial intelligence";
        int start = 2023;
        int end = 2024;
        return new Project(title, details, null, start, end);
    }
}
