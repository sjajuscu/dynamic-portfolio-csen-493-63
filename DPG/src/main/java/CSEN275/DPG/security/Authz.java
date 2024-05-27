package CSEN275.DPG.security;

import CSEN275.DPG.model.Portfolio;
import CSEN275.DPG.model.User;
import CSEN275.DPG.repository.PortfolioRepository;
import CSEN275.DPG.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;

import java.util.Objects;
import java.util.Optional;

//@Component
public class Authz {

    @Autowired
    UserRepository userRepository;

    @Autowired
    PortfolioRepository portfolioRepository;

    public boolean canEditUser(Long id) {
        Authentication authentication = SecurityContextHolder.getContext().getAuthentication();
        if (authentication == null) {
            return false;
        }
        Optional<User> optionalUser = userRepository.findById(id);
        return optionalUser.filter(user -> Objects.equals(user.getName(), authentication.getName())).isPresent();
    }

    public boolean canEditPortfolio(Long id) {
        Authentication authentication = SecurityContextHolder.getContext().getAuthentication();
        if (authentication == null) {
            return false;
        }
        User user = userRepository.findFirstByName(authentication.getName());
        if (user == null) {
            return false;
        }
        Optional<Portfolio> optionalPortfolio = portfolioRepository.findById(id);
        return optionalPortfolio.filter(p -> Objects.equals(p.getUserId(), user.getId())).isPresent();
    }
}
