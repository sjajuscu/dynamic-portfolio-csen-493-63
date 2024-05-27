package CSEN275.DPG;

import CSEN275.DPG.model.EducationalDetails;
import CSEN275.DPG.model.ExperienceDetails;
import CSEN275.DPG.model.Portfolio;
import CSEN275.DPG.model.Project;
import CSEN275.DPG.model.User;
import CSEN275.DPG.repository.PortfolioRepository;
import CSEN275.DPG.repository.UserRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.boot.CommandLineRunner;
import org.springframework.context.annotation.Configuration;

@Configuration
public class LoadDatabase {
    private static final Logger log = LoggerFactory.getLogger(LoadDatabase.class);

//    @Bean
    CommandLineRunner initDatabase(UserRepository userRepository, PortfolioRepository portfolioRepository) {
        return args -> {
            User defaultUser = new User();
            User adminUser = new User();
            userRepository.save(defaultUser);
            userRepository.save(adminUser);
            userRepository.findAll().forEach(user -> log.info("Preloaded {}", user));

            Portfolio seedPortfolio = getSeedPortfolio(defaultUser);
            portfolioRepository.save(seedPortfolio);
            portfolioRepository.findAll().forEach(portfolio -> log.info("Preloaded {}", portfolio));
        };
    }

    private static Portfolio getSeedPortfolio(User defaultUser) {
        Portfolio seedPortfolio = new Portfolio(defaultUser);
        EducationalDetails seedEducation = new EducationalDetails("school", "Master", "CSEN", 2024, 2024);
        ExperienceDetails seedExperience = new ExperienceDetails("company", "details", 2024, 2024);
        Project seedProject = new Project("title", "desc", null, 2024, 2024);
        seedPortfolio.addEducationalDetails(seedEducation);
        seedPortfolio.addExperienceDetails(seedExperience);
        seedPortfolio.addProject(seedProject);
        return seedPortfolio;
    }
}
