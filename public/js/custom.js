// ===== CUSTOM JAVASCRIPT FOR EXPENSE TRACKER =====

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all custom functionality
    initAnimations();
    initCharts();
    initFormEnhancements();
    initInteractiveElements();
});

// ===== ANIMATIONS =====
function initAnimations() {
    // Add loading animation to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.getAttribute('type') === 'submit' || this.href) {
                this.classList.add('loading');
                this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
            }
        });
    });
    
    // Add hover effects to cards
    const cards = document.querySelectorAll('.panel');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// ===== CHART ENHANCEMENTS =====
function initCharts() {
    // Enhanced EasyPieChart animations
    if (typeof $.fn.easyPieChart !== 'undefined') {
        $('.easypiechart').easyPieChart({
            easing: 'easeOutBounce',
            barColor: function(percent) {
                // Dynamic color based on percentage
                if (percent < 30) return '#38B000'; // Green
                if (percent < 60) return '#FF9E00'; // Orange
                return '#E63946'; // Red
            },
            trackColor: '#f2f2f2',
            scaleColor: false,
            lineWidth: 10,
            lineCap: 'round',
            animate: 2000,
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text('KSh ' + Math.round(percent).toLocaleString());
            }
        });
    }
    
    // Add chart hover effects
    $('.easypiechart').hover(
        function() {
            $(this).css('transform', 'scale(1.1)');
        },
        function() {
            $(this).css('transform', 'scale(1)');
        }
    );
}

// ===== FORM ENHANCEMENTS =====
function initFormEnhancements() {
    // Auto-format currency inputs
    const currencyInputs = document.querySelectorAll('input[type="number"]');
    currencyInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
        
        input.addEventListener('focus', function() {
            this.select();
        });
    });
    
    // Add character counters to textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        const counter = document.createElement('div');
        counter.className = 'text-muted small mt-1 text-end';
        counter.textContent = `0/${textarea.maxLength || '∞'} characters`;
        textarea.parentNode.appendChild(counter);
        
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            const max = this.maxLength || '∞';
            counter.textContent = `${count}/${max} characters`;
            
            if (this.maxLength && count > this.maxLength * 0.8) {
                counter.style.color = '#E63946';
            } else {
                counter.style.color = '#6C757D';
            }
        });
    });
}

// ===== INTERACTIVE ELEMENTS =====
function initInteractiveElements() {
    // Add confirmation for delete actions
    const deleteButtons = document.querySelectorAll('.btn-danger, a[href*="delete"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
    
    // Add toast notifications
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease;
        `;
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 5000);
    };
    
    // Auto-dismiss alerts after 5 seconds
    const autoAlerts = document.querySelectorAll('.alert:not(.alert-permanent)');
    autoAlerts.forEach(alert => {
        setTimeout(() => {
            if (alert.parentNode) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);
    });
    
    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+D for dashboard
        if (e.ctrlKey && e.key === 'd') {
            e.preventDefault();
            window.location.href = '/dashboard';
        }
        
        // Ctrl+A for add expense
        if (e.ctrlKey && e.key === 'a') {
            e.preventDefault();
            window.location.href = '/expenses/add';
        }
        
        // Escape key to go back
        if (e.key === 'Escape') {
            window.history.back();
        }
    });
}

// ===== UTILITY FUNCTIONS =====
function formatKES(amount) {
    return 'KSh ' + parseFloat(amount).toLocaleString('en-KE', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function formatDate(dateString) {
    const options = { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return new Date(dateString).toLocaleDateString('en-KE', options);
}

// ===== PERFORMANCE OPTIMIZATIONS =====
// Lazy loading for images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img.lazy').forEach(img => {
        imageObserver.observe(img);
    });
}

// Export functions for global use
window.ExpenseTracker = {
    formatKES,
    formatDate,
    showToast: window.showToast
};